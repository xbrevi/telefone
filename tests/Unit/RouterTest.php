<?php

namespace Tests\Unit;

use Tests\TestCase;

class RouterTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */

    public function testRouter()
    {
        $response = $this->get('/');
        $response->assertStatus(302);

        $response = $this->get('/home');
        $response->assertStatus(302);

        $response = $this->get(route('form_listar_territorios'));
        $response->assertStatus(302);

        $response = $this->get('/criar');
        $response->assertStatus(302);

        $response = $this->post('/criar');
        $response->assertStatus(302);

        $response = $this->get(route('form_criar_territorio'));
        $response->assertStatus(302);

        // id territorio
        $id = 1;

        $response = $this->get(route('form_editar_territorio', ['id' => $id]));
        $response->assertStatus(302);

        $response = $this->post(route('form_atualizar_territorio', ['id' => $id]));
        $response->assertStatus(302);

        $response = $this->get(route('form_apagar_territorio', ['territorioId' => $id]));
        $response->assertStatus(302);

        $response = $this->get(route('form_listar_telefones', ['territorioId' => $id]));
        $response->assertStatus(302);

    }
}
