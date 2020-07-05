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
        $images  = collect(array_slice(scandir(storage_path() .'/app/public/images'), 2));
        
        $preserved = collect(json_decode(file_get_contents(storage_path() .'/app/public/corruptions.json'))->corruptions);
        
        foreach($preserved as $item) {

            $name        = explode(': ', $item->name)[1];
            $rank        = substr($item->preview_item->spells[0]->spell->name, -1);
            $spellId     = $item->preview_item->spells[0]->spell->id;
            $description = explode("N'Zoth's Corruption.", $item->preview_item->spells[0]->description)[1];
            $description = trim(str_replace("\r\n\r\n\r\n", " ", $description));
            $description = substr($description, strpos($description, "\r\n") + 2);
            
            $corruption = Corruption::firstOrCreate([
                'name'         => "$name - $rank",
                'description'  => $description,
                'wowhead_link' => "https://www.wowhead.com/spell=$spellId",
                'corr_cost'    => $item->preview_item->name_description->display_string
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
