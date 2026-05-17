<?php

namespace Database\Factories;

trait UkUsFaker
{
    /**
     * @return array{first:string,last:string,gender:string}
     */
    protected function ukUsPerson(): array
    {
        $gender = fake()->randomElement(['Male', 'Female']);

        $maleNames = ['Oliver', 'George', 'Harry', 'Jack', 'Noah', 'James', 'William', 'Benjamin', 'Lucas', 'Henry'];
        $femaleNames = ['Olivia', 'Amelia', 'Isla', 'Ava', 'Mia', 'Emma', 'Charlotte', 'Sophia', 'Grace', 'Ella'];
        $lastNames = ['Smith', 'Johnson', 'Williams', 'Brown', 'Jones', 'Taylor', 'Wilson', 'Evans', 'Thomas', 'Walker'];

        return [
            'first' => fake()->randomElement($gender === 'Male' ? $maleNames : $femaleNames),
            'last' => fake()->randomElement($lastNames),
            'gender' => $gender,
        ];
    }

    protected function ukUsPhone(): string
    {
        if (fake()->boolean()) {
            return '+44 7' . fake()->numerify('### ### ###');
        }

        return '+1 ' . fake()->numerify('(###) ###-####');
    }

    /**
     * @return array{address:string,address2:string|null,city:string,state:string,zip:string}
     */
    protected function ukUsAddress(): array
    {
        $locations = [
            ['London', 'England', 'SW1A 1AA', 'Downing Street'],
            ['Manchester', 'England', 'M1 1AE', 'Deansgate'],
            ['Birmingham', 'England', 'B1 1BB', 'New Street'],
            ['Edinburgh', 'Scotland', 'EH1 1RE', 'Princes Street'],
            ['Cardiff', 'Wales', 'CF10 1EP', 'Queen Street'],
            ['New York', 'NY', '10001', 'Madison Avenue'],
            ['Los Angeles', 'CA', '90001', 'Sunset Boulevard'],
            ['Chicago', 'IL', '60601', 'Michigan Avenue'],
            ['Boston', 'MA', '02108', 'Beacon Street'],
            ['Seattle', 'WA', '98101', 'Pine Street'],
        ];

        [$city, $state, $zip, $street] = fake()->randomElement($locations);

        return [
            'address' => fake()->numberBetween(1, 250) . ' ' . $street,
            'address2' => fake()->optional(0.45)->randomElement(['Flat ' . fake()->numberBetween(1, 20), 'Apt ' . fake()->numberBetween(1, 20), 'Suite ' . fake()->numberBetween(100, 999)]),
            'city' => $city,
            'state' => $state,
            'zip' => $zip,
        ];
    }
}
