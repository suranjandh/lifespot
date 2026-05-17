<?php

namespace Database\Factories;

trait SriLankanFaker
{
    /**
     * @return array{first:string,last:string,gender:string}
     */
    protected function sriLankanPerson(): array
    {
        $gender = fake()->randomElement(['Male', 'Female']);

        $maleNames = ['Kasun', 'Nuwan', 'Chamath', 'Dinesh', 'Lahiru', 'Tharindu', 'Isuru', 'Roshan', 'Sajith', 'Ravindu'];
        $femaleNames = ['Ama', 'Dilini', 'Nethmi', 'Tharushi', 'Sachini', 'Hiruni', 'Kavindi', 'Imalka', 'Nimali', 'Anjali'];
        $lastNames = ['Perera', 'Fernando', 'Silva', 'Jayasinghe', 'Wijesinghe', 'Bandara', 'Gunawardena', 'Herath', 'Rajapaksha', 'Dissanayake'];

        return [
            'first' => fake()->randomElement($gender === 'Male' ? $maleNames : $femaleNames),
            'last' => fake()->randomElement($lastNames),
            'gender' => $gender,
        ];
    }

    protected function sriLankanPhone(): string
    {
        return '+94 7' . fake()->randomElement(['0', '1', '2', '4', '5', '6', '7', '8']) . ' ' . fake()->numerify('### ####');
    }

    /**
     * @return array{address:string,address2:string,city:string,state:string,zip:string}
     */
    protected function sriLankanAddress(): array
    {
        $cities = [
            ['Colombo', 'Western Province', '00700'],
            ['Kandy', 'Central Province', '20000'],
            ['Galle', 'Southern Province', '80000'],
            ['Jaffna', 'Northern Province', '40000'],
            ['Negombo', 'Western Province', '11500'],
            ['Kurunegala', 'North Western Province', '60000'],
            ['Anuradhapura', 'North Central Province', '50000'],
            ['Matara', 'Southern Province', '81000'],
            ['Ratnapura', 'Sabaragamuwa Province', '70000'],
            ['Batticaloa', 'Eastern Province', '30000'],
        ];

        [$city, $state, $zip] = fake()->randomElement($cities);

        return [
            'address' => 'No. ' . fake()->numberBetween(1, 250) . ', ' . fake()->randomElement(['Galle Road', 'Temple Road', 'Lake Road', 'Kandy Road', 'Station Road', 'Hospital Lane']),
            'address2' => fake()->optional(0.45)->randomElement(['Apt ' . fake()->numberBetween(1, 20), 'Lane ' . fake()->numberBetween(1, 8), 'Near ' . fake()->randomElement(['Post Office', 'Railway Station', 'Central Market'])]),
            'city' => $city,
            'state' => $state,
            'zip' => $zip,
        ];
    }
}
