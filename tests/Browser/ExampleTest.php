<?php

namespace Tests\Browser;

use App\Models\User;
use Exception;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ExampleTest extends DuskTestCase
{
    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('http://localhost:8000/login')
                    ->value('#exampleInputEmail', 'sp@mail.com')
                    ->value('#exampleInputPassword', '123456')
                    ->click('button[type="submit"]')
                    ->assertPathIs('/dashboard');
        });
    }
}
