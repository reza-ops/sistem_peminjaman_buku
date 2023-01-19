<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class KategoriTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('http://localhost:8000/login')
            ->value('#exampleInputEmail', 'sp@mail.com')
            ->value('#exampleInputPassword', '123456')
            ->click('button[type="submit"]')
            ->assertPathIs('/dashboard')
            ->visit('http://localhost:8000/master/kategori')
            ->assertPathIs('/master/kategori');

            // create
            // $browser->click('.btn-success')
            // ->assertPathIs('/master/kategori/create')
            // ->value('#nama', 'Art')
            // ->value('#deskripsi', 'Art Desc')
            // ->click('button[type="submit"]')
            // ->click('.swal2-confirm')
            // ->assertPathIs('/master/kategori');

            // update
            $browser->visit('http://localhost:8000/master/kategori/103/edit')
            ->assertPathIs('/master/kategori/103/edit')
            ->value('#nama', 'Art1')
            ->value('#deskripsi', 'Art Desc33')
            ->click('button[type="submit"]')
            ->click('.swal2-confirm')
            ->assertPathIs('/master/kategori');
        });
    }

}
