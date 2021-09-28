<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{
    /**
     * A basic browser test login.
     *
     * @return void
     */
  public function testAddRegisterSuccess()
  {
    $data = array(
      'email' => 'diego@renovedigital.com.br',
      'password' => '1234567',
    );

    // Gerador de dados falsos
    $this->browse(function (Browser $browser) use ($data){

      $email = $data['email'];
      $password = $data['password'];

      $browser->visit('/login') // Acessa a rota que de cadastro
        ->type('email', $email) // Preenche email
        ->type('password', $password) // Preenche passoword
        ->press('Logar') // Clica em "Salvar"
        ->assertPathIs('/api/login') // Testa se fui redirecionado para a rota da lista
        ->waitUntil('body.loaded_image');
        // ->assertSee('email', $email) // Testa se o email preenchido está na lista
        // ->assertSee('password', $password); // Testa se o password preenchido está na lista
    });
  }
}
