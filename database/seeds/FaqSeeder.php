<?php

use Faker\Factory as Faker;
use App\Model\FaqModel as Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$faker = Faker::create();

		foreach (range(1,30) as $key) {

			$faq = new Faq();

			$data = $faker->randomElement(['yes_no','open_ended']);
			if ($data == 'yes_no') {
				$answer = $faker->randomElement(['Yes','No']);
			}else {
				$answer = $faker->paragraph(4);
			}
			$leng = $faker->numberBetween($min = 1 , $max = 4);
			for ($i=0; $i < $leng; $i++) { 
				$section[] = $faker->sentence(5);
			}
			$faq->create([
				'question' => $faker->sentence(5),
				'answer' => $answer,
				'question_type' => $data,
				'official_basis' =>  $faker->sentence(5),
				'sections'	=> $section,
				'url'	=> $faker->url(),
				]);

			$section = [];
		}
	}

}
