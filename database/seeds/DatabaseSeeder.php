<?php

use App\Models\Corruption;
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
        
        $preserved = json_decode(file_get_contents(storage_path() .'/app/public/corruptions.json'))->corruptions;


        foreach($preserved as $item) {
            
            $corruption = Corruption::create([
                'name'         => $item->name . " " . substr($item->preview_item->spells[0]->spell->name, -1),
                'description'  => trim(str_replace("\r\n\r\n\r\n", " ", explode("Use: Imbue an item with a malignant strain of N'Zoth's Corruption.", $item->preview_item->spells[0]->description)[1])),
                'wowhead_link' => "https://www.wowhead.com/spell={$item->preview_item->spells[0]->spell->id}",
                'corr_cost'    => $item->preview_item->name_description->display_string
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
