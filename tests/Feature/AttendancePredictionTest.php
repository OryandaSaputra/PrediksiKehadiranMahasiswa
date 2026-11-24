<?php

namespace Tests\Feature;

use Tests\TestCase;

class AttendancePredictionTest extends TestCase
{
    public function test_prediction_page_renders_the_indonesian_interface_and_institution_logo(): void
    {
        $response = $this->get('/');

        $response->assertOk()
            ->assertSee('Prediksi Kehadiran Mahasiswa')
            ->assertSee('logo-pcr-unggul.webp');
    }

    public function test_prediction_endpoint_keeps_the_existing_response_contract(): void
    {
        $response = $this->postJson('/predict', [
            'on_time_frequency' => 'Selalu',
            'semester_compensations' => '0 - 5 jam',
            'organization_absences' => 'Tidak Pernah',
        ]);

        $response->assertOk()->assertExactJson([
            'message' => 'Prediksi persentase kehadiran Anda adalah: 80% - 85%',
        ]);
    }

    public function test_prediction_endpoint_keeps_existing_rules_and_unknown_combinations(): void
    {
        $knownResponse = $this->postJson('/predict', [
            'on_time_frequency' => 'Selalu',
            'semester_compensations' => '> 10 jam',
            'organization_absences' => 'Jarang',
        ]);

        $knownResponse->assertOk()->assertExactJson([
            'message' => 'Prediksi persentase kehadiran Anda adalah: 91% - 100%',
        ]);

        $unknownResponse = $this->postJson('/predict', [
            'on_time_frequency' => 'Selalu',
            'semester_compensations' => '6 - 9 jam',
            'organization_absences' => 'Jarang',
        ]);

        $unknownResponse->assertOk()->assertExactJson([
            'message' => 'Prediksi persentase kehadiran Anda adalah: Tidak diketahui',
        ]);
    }
}
