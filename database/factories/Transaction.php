<?php

namespace Database\Factories;

use App\Abstracts\Factory;
use App\Interfaces\Utility\TransactionNumber;
use App\Models\Banking\Transaction as Model;
use App\Models\Common\Contact;
use App\Traits\Transactions;
use App\Utilities\Date;

class Transaction extends Factory
{
    use Transactions;

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Model::class;

    /**
     * The type of the model.
     *
     * @var string
     */
    protected $type = 'income';

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $types = array_merge($this->getIncomeTypes(), $this->getExpenseTypes());
        $this->type = $this->faker->randomElement($types);

        $category_type = in_array($this->type, $this->getIncomeTypes()) ? 'income' : 'expense';

        return [
            'company_id' => $this->company->id,
            'type' => $this->type,
            'number' => $this->getNumber($this->type),
            'account_id' => setting('default.account'),
            'paid_at' => $this->faker->dateTimeBetween(now()->startOfYear(), now()->endOfYear())->format('Y-m-d H:i:s'),
            'amount' => $this->faker->randomFloat(2, 1, 1000),
            'currency_code' => default_currency(),
            'currency_rate' => '1.0',
            'description' => $this->faker->text(5),
        $categories = $this->company->categories()->$category_type()->get();
        $category_id = $categories->count() ? $categories->random(1)->pluck('id')->first() : \App\Models\Setting\Category::factory()->$category_type()->create(['company_id' => $this->company->id])->id;

        return [
            'company_id' => $this->company->id,
            'type' => $this->type,
            'number' => $this->getNumber($this->type),
            'account_id' => setting('default.account'),
            'paid_at' => $this->faker->dateTimeBetween(now()->startOfYear(), now()->endOfYear())->format('Y-m-d H:i:s'),
            'amount' => $this->faker->randomFloat(2, 1, 1000),
            'currency_code' => default_currency(),
            'currency_rate' => '1.0',
            'description' => $this->faker->text(5),
            'category_id' => $category_id,
            'reference' => $this->faker->text(5),
            'payment_method' => setting('default.payment_method'),
            'created_from' => 'core::factory',
        ];
    }

    /**
     * Indicate that the model type is income.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function income()
    {
        return $this->state(function (array $attributes): array {
            $contacts = Contact::customer()->enabled()->get();

            if ($contacts->count()) {
                $contact = $contacts->random(1)->first();
            } else {
                $contact = Contact::factory()->customer()->enabled()->create();
            }

            $income_categories = $this->company->categories()->income()->get();
            $income_category_id = $income_categories->count() ? $income_categories->random(1)->pluck('id')->first() : \App\Models\Setting\Category::factory()->income()->create(['company_id' => $this->company->id])->id;

            return [
                'type' => 'income',
                'number' => $this->getNumber('income', '', $contact),
                'contact_id' => $contact->id,
                'category_id' => $income_category_id,
            ];
        });
    }

    /**
     * Indicate that the model type is expense.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function expense()
    {
        return $this->state(function (array $attributes): array {
            $contacts = Contact::vendor()->enabled()->get();

            if ($contacts->count()) {
                $contact = $contacts->random(1)->first();
            } else {
                $contact = Contact::factory()->vendor()->enabled()->create();
            }

            $expense_categories = $this->company->categories()->expense()->get();
            $expense_category_id = $expense_categories->count() ? $expense_categories->random(1)->pluck('id')->first() : \App\Models\Setting\Category::factory()->expense()->create(['company_id' => $this->company->id])->id;

            return [
                'type' => 'expense',
                'number' => $this->getNumber('expense', '', $contact),
                'contact_id' => $contact->id,
                'category_id' => $expense_category_id,
            ];
        });
    }

    /**
     * Indicate that the model is recurring.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function recurring()
    {
        $type = $this->getRawAttribute('type') . '-recurring';

        return $this->state([
            'type' => $type,
            'number' => $this->getNumber($type, '-recurring'),
            'recurring_started_at' => Date::now()->format('Y-m-d H:i:s'),
            'recurring_frequency' => 'daily',
            'recurring_custom_frequency' => 'daily',
            'recurring_interval' => '1',
            'recurring_limit' => 'date',
            'recurring_limit_date' => Date::now()->addDay(7)->format('Y-m-d H:i:s'),
            'disabled_transaction_paid' => "Auto-generated",
            'disabled_transaction_number' => "Auto-generated",
            'real_type' => $this->getRawAttribute('type'),
        ]);
    }

    /**
     * Get transaction number
     *
     */
    public function getNumber($type, $suffix = '', $contact = null)
    {
        $utility = app(TransactionNumber::class);

        $number = $utility->getNextNumber($type, $suffix, $contact);

        $utility->increaseNextNumber($type, $suffix ,$contact);

        return $number;
    }
}
