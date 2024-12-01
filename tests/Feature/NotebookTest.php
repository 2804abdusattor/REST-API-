<?php

namespace Tests\Feature;

use Tests\TestCase;

class NotebookTest extends TestCase
{
    /**
     * Тест создания записи в блокноте.
     *
     * @return void
     */
    public function testCreateNotebook()
    {
        // Отправка POST-запроса на создание записи
        $response = $this->postJson('/api/v1/notebook', [
            'name'  => 'John Doe',
            'phone' => '1234567890',
            'email' => 'john@example.com',
        ]);

        // Проверка, что статус ответа 201 (создано)
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'id', 'name', 'phone', 'email', 'created_at', 'updated_at'
                 ]);
    }
}
