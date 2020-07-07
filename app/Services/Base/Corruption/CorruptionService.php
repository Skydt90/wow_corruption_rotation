<?php

namespace App\Services\Base\Corruption;

use stdClass;
use App\Services\Base\BaseService;
use App\Repositories\Base\Corruption\CorruptionRepoInterface;
use App\Repositories\Base\Picture\PictureRepoInterface;

class CorruptionService extends BaseService implements CorruptionServiceInterface
{
    private $pictureRepo;

    public function __construct(CorruptionRepoInterface $repo, PictureRepoInterface $pictureRepo)
    {
        $this->repo = $repo;
        $this->pictureRepo = $pictureRepo;
    }

    public function fetchFromFile()
    {
        $preserved = collect(json_decode(file_get_contents(storage_path() .'/app/corruptions.json'))->corruptions);
        $structure = collect(json_decode(file_get_contents(storage_path() .'/app/corruption-structure.json'))->structure);        
        
        $preserved->each(function($item) use($structure) {
            
            $container = new stdClass();
            
            $structure->each(function($entry) use($item, $container) {
                
                if ($entry->id === $item->id) {
                    $container->name         = $entry->data->name;
                    $container->echo_cost    = $entry->data->echo_cost;
                    $container->wowhead_link = 'https://www.wowhead.com/spell='.$entry->data->wowhead_id;
                    return;
                }
            });
            
            $description = explode("N'Zoth's Corruption.", $item->preview_item->spells[0]->description)[1];
            $description = trim(str_replace("\r\n\r\n\r\n", " ", $description));
            $description = substr($description, strpos($description, "\r\n") + 2);
            
            $container->blizz_item_id = $item->id;
            $container->description   = $description;
            $container->corr_cost     = $item->preview_item->name_description->display_string;
            
            $this->saveFileData($container);
        }); 
    }

    private function saveFileData($container)
    {
        $container = $this->repo->createFromFile($container);
        $container->picture_path = 'public/images/'.strtolower(explode(' I', $container->name)[0]).".jpg";    
        $this->pictureRepo->createFromFile($container);
    }
}