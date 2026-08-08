<?php

namespace Database\Factories;

use App\Abstracts\Factory;
use App\Models\Common\Item as Model;

class Item extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Model::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $types = ['product', 'service'];

        $categories = $this->company->categories()->item()->get();
        $category_id = $categories->count() ? $categories->random(1)->pluck('id')->first() : \App\Models\Setting\Category::factory()->item()->create(['company_id' => $this->company->id])->id;

        return [
            'company_id' => $this->company->id,
            'type' => $this->faker->randomElement($types),
            'name' => $this->faker->text(15),
            'description' => $this->faker->text(100),
            'purchase_price' => $this->faker->randomFloat(2, 10, 20),
            'sale_price' => $this->faker->randomFloat(2, 10, 20),
            'category_id' => $category_id,
            'enabled' => $this->faker->boolean ? 1 : 0,
            'created_from' => 'core::factory',
        ];
    }

    /**
     * Indicate that the model is enabled.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function enabled()
    {
        return $this->state([
            'enabled' => 1,
        ]);
    }

    /**
     * Indicate that the model is disabled.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function disabled()
    {
        return $this->state([
            'enabled' => 0,
        ]);
    }
}
