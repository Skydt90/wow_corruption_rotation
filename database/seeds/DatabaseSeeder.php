<?php

use App\Models\Corruption;
use App\Models\Picture;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $spells = [
            177977 => ['name' => 'Gushing Wound', 'echo_cost' => 4125, 'wowhead_id' => 318179],
            177973 => ['name' => 'Expedient I', 'echo_cost' => 3000, 'wowhead_id' => 315544],
            177974 => ['name' => 'Expedient II', 'echo_cost' => 4125, 'wowhead_id' => 315545],
            177975 => ['name' => 'Expedient III', 'echo_cost' => 5000, 'wowhead_id' => 315546],
            178010 => ['name' => 'Versatile I', 'echo_cost' => 3000, 'wowhead_id' => 315549],
            178011 => ['name' => 'Versatile II', 'echo_cost' => 4125, 'wowhead_id' => 315552],
            178012 => ['name' => 'Versatile III', 'echo_cost' => 5000, 'wowhead_id' => 315553],
            177992 => ['name' => 'Severe I', 'echo_cost' => 3000, 'wowhead_id' => 315554],
            177993 => ['name' => 'Severe II', 'echo_cost' => 4125, 'wowhead_id' => 315557],
            177994 => ['name' => 'Severe III', 'echo_cost' => 5000, 'wowhead_id' => 315558],
            177987 => ['name' => 'Masterful II', 'echo_cost' => 4125, 'wowhead_id' => 315530],
            177988 => ['name' => 'Masterful III', 'echo_cost' => 5000, 'wowhead_id' => 315531],
            177981 => ['name' => 'Ineffable Truth I', 'echo_cost' => 3300, 'wowhead_id' => 318303],
            177982 => ['name' => 'Ineffable Truth II', 'echo_cost' => 6750, 'wowhead_id' => 318484],
            177983 => ['name' => 'Infinite Stars I', 'echo_cost' => 5000, 'wowhead_id' => 318274],
            177984 => ['name' => 'Infinite Stars II', 'echo_cost' => 10000, 'wowhead_id' => 318487],
            177985 => ['name' => 'Infinite Stars III', 'echo_cost' => 15000, 'wowhead_id' => 318488],
            178007 => ['name' => 'Twisted Appendage I', 'echo_cost' => 3000, 'wowhead_id' => 318481],
            178008 => ['name' => 'Twisted Appendage II', 'echo_cost' => 7875, 'wowhead_id' => 318482],
            178009 => ['name' => 'Twisted Appendage III', 'echo_cost' => 13200, 'wowhead_id' => 318483],
            178004 => ['name' => 'Twilight Devastation I', 'echo_cost' => 6250, 'wowhead_id' => 318276],
            178005 => ['name' => 'Twilight Devastation II', 'echo_cost' => 10000, 'wowhead_id' => 318477],
            178006 => ['name' => 'Twilight Devastation III', 'echo_cost' => 15000, 'wowhead_id' => 318478],
            177979 => ['name' => 'Honed Mind II', 'echo_cost' => 5000, 'wowhead_id' => 318494],
            178002 => ['name' => 'Surging Vitality II', 'echo_cost' => 5000, 'wowhead_id' => 318495],
            177998 => ['name' => 'Strikethrough I', 'echo_cost' => 3000, 'wowhead_id' => 315277],
            177999 => ['name' => 'Strikethrough II', 'echo_cost' => 4125, 'wowhead_id' => 315281],
            178000 => ['name' => 'Strikethrough III', 'echo_cost' => 5000, 'wowhead_id' => 315282],
            177989 => ['name' => 'Racing Pulse I', 'echo_cost' => 4125, 'wowhead_id' => 318266],
            177990 => ['name' => 'Racing Pulse II', 'echo_cost' => 5000, 'wowhead_id' => 318492],
            177991 => ['name' => 'Racing Pulse III', 'echo_cost' => 7875, 'wowhead_id' => 318496],
            177968 => ['name' => 'Echoing Void II', 'echo_cost' => 7875, 'wowhead_id' => 318485],
            177971 => ['name' => 'Avoidant II', 'echo_cost' => 3300, 'wowhead_id' => 315608],
            177972 => ['name' => 'Avoidant III', 'echo_cost' => 4250, 'wowhead_id' => 315609],
            177966 => ['name' => 'Deadly Momentum III', 'echo_cost' => 7875, 'wowhead_id' => 318497],

        ];


        $images  = collect(array_slice(scandir(storage_path() .'/app/public/images'), 2));
        
        $preserved = collect(json_decode(file_get_contents(storage_path() .'/app/public/corruptions.json'))->corruptions);
        
        foreach($preserved as $item) {

            $name        = explode(': ', $item->name)[1];
            $rank        = substr($item->preview_item->spells[0]->spell->name, -1);
            //$spellId     = $item->preview_item->spells[0]->spell->id;
            $description = explode("N'Zoth's Corruption.", $item->preview_item->spells[0]->description)[1];
            $description = trim(str_replace("\r\n\r\n\r\n", " ", $description));
            $description = substr($description, strpos($description, "\r\n") + 2);
            
            $corruption = Corruption::firstOrCreate([
                'name'          => "$name - $rank",
                'description'   => $description,
                'wowhead_link'  => "https://www.wowhead.com/item=$item->id",
                'corr_cost'     => $item->preview_item->name_description->display_string,
                'blizz_item_id' => $item->id,
            ]);
            
            $picture = Picture::firstOrCreate([
                'path' => 'public/images/'.strtolower($name).".jpg",
                'corruption_id' => $corruption->id,
            ]);
        
        }
        dd(123);
        if ($this->whaleService->get()->count() === 0) {
            $this->command->getOutput()->writeln('Fetching data from api..');

            $this->whaleService->fetchLegacyData();
            
            $this->command->getOutput()->writeln('Success!');
        } else {
            $this->command->getOutput()->writeln('Legacy data allready in DB');
        }
    }
}
