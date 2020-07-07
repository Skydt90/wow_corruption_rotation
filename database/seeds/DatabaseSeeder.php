<?php

use App\Models\Corruption;
use App\Models\Picture;
use App\Models\Rotation;
use Illuminate\Database\Seeder;
use App\Services\Base\Corruption\CorruptionServiceInterface;

class DatabaseSeeder extends Seeder
{
    private $corruptionService;

    public function __construct(CorruptionServiceInterface $corruptionService)
    {
        $this->corruptionService = $corruptionService;
    }

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {   
        $this->corruptionService->test();
        $preserved = json_decode(file_get_contents(storage_path() .'/app/corruptions.json'))->corruptions;
        $structure = collect(json_decode(file_get_contents(storage_path(). '/app/corruption-structure.json'))->structure);
        $rotations = json_decode(file_get_contents(storage_path() .'/app/rotations.json'))->rotations;
        
        foreach($preserved as $item) {
            $name         = '';
            $wowhead_link = '';
            $echo_cost    = 0;

            $structure->each(function($entry) use($item, &$name, &$wowhead_link, &$echo_cost) {
                
                if ($entry->id === $item->id) {
                    $name         = $entry->data->name;
                    $echo_cost    = $entry->data->echo_cost;
                    $wowhead_link = 'https://www.wowhead.com/spell='.$entry->data->wowhead_id;

                    return;
                }
            });
          
            $description = explode("N'Zoth's Corruption.", $item->preview_item->spells[0]->description)[1];
            $description = trim(str_replace("\r\n\r\n\r\n", " ", $description));
            $description = substr($description, strpos($description, "\r\n") + 2);
            
            $corruption = Corruption::firstOrCreate([
                'name'          => $name,
                'description'   => $description,
                'wowhead_link'  => $wowhead_link,
                'corr_cost'     => $item->preview_item->name_description->display_string,
                'echo_cost'     => $echo_cost,
                'blizz_item_id' => $item->id,
            ]);
            
            $picture = Picture::firstOrCreate([
                'path' => 'public/images/'.strtolower($name).".jpg",
                'corruption_id' => $corruption->id,
            ]);
        }

        for($i = 1; $i <= 8; $i++) {
            $corruptions = [];

            foreach($rotations as $rota) {
                if ($rota->title === "Rotation $i") {
                    foreach($rota->corruptions as $corruption) {
                        $corruptions[] = Corruption::where('name', $corruption)->first()->id;
                    }
                    break;
                }
            }
            
            $rotation = Rotation::firstOrCreate([
                'name' => "Rotation $i",
            ]);
            $rotation->corruptions()->sync($corruptions);
        }
        
        $test = Rotation::with('corruptions')->find(8);
        $test->corruptions->each(function($corr) {
            dump($corr->name);
        });
        dd();
        /* if ($this->whaleService->get()->count() === 0) {
            $this->command->getOutput()->writeln('Fetching data from api..');

            $this->whaleService->fetchLegacyData();
            
            $this->command->getOutput()->writeln('Success!');
        } else {
            $this->command->getOutput()->writeln('Legacy data allready in DB');
        } */
    }
}
