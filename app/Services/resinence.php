<?php
namespace App\Services;

class Resinence
{

    public function slide()
    {
        $month = date("m");
        $slide = collect([
            '01'=>'01.jpg',
            '02'=>'02.jpg',
            '03'=>'03.jpg',
            '04'=>'04.jpg',
            '05'=>'05.jpg',
            '06'=>'06.jpg',
            '07'=>'07.jpg',
            '08'=>'08.jpg',
            '09'=>'09.jpg',
            '10'=>'10.jpg',
            '11'=>'11.jpg',
            '12'=>'12.jpg'
        ]);
        return $slide[$month];
    }

    public function citation()
    {
        $month = date("m");
        $citation = collect([
            '01'=>"With Résinet it's the party!",
            '02'=>"Résinet is nice!",
            '03'=>"Résinet is ready!",
            '04'=>"With Résinet, no headache!",
            '05'=>"Resinet is on the controller!",
            '06'=>"Put your deck, there is Résinet",
            '07'=>"Hi little girls, here is Resinet!",
            '08'=>"Do not look at the seagulls, you have Résinet!",
            '09'=>"With Résinet no need for calculator!",
            '10'=>"Resinet is not a woman!",
            '11'=>"With Résinet finished doing the quest!",
            '12'=>"We do not make an omelet without Résinet!"
        ]);
        return $citation[$month];
    }

}
