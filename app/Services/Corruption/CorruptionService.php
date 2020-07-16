<?php

namespace App\Services\Corruption;

use stdClass;
use App\Services\BaseService;
use App\Repositories\Picture\PictureRepoInterface;
use App\Repositories\Rotation\RotationRepoInterface;
use App\Repositories\Corruption\CorruptionRepoInterface;

class CorruptionService extends BaseService implements CorruptionServiceInterface
{
    private $pictureRepo;
    private $rotationRepo;

    public function __construct(CorruptionRepoInterface $repo, PictureRepoInterface $pictureRepo, RotationRepoInterface $rotationRepo)
    {
        $this->repo = $repo;
        $this->pictureRepo = $pictureRepo;
        $this->rotationRepo = $rotationRepo;
    }

    /**
     * Fetches all file data and creates each corruption fetched from api with appended custom data
     *
     * @return void
     */
    public function fetchFromFile()
    {
        // Fetch all data from files
        $preserved = collect(json_decode(file_get_contents(storage_path() .'/app/corruptions.json'))->corruptions);
        $structure = collect(json_decode(file_get_contents(storage_path() .'/app/corruption-structure.json'))->structure);
        $rotations = collect(json_decode(file_get_contents(storage_path() .'/app/rotations.json'))->rotations);

        // Loop all 52 preserved items
        $preserved->each(function($item) use($structure, $rotations) {
            $container = new stdClass();

            // Loop custom data structure to append extra data
            $structure->each(function($entry) use($item, $container) {
                if ($entry->id === $item->id) {
                    $container->name         = $entry->data->name;
                    $container->echo_cost    = $entry->data->echo_cost;
                    $container->wowhead_link = 'https://www.wowhead.com/spell='.$entry->data->wowhead_id;
                    return;
                }
            });
            // Loop rotation data to assign correct id's to corruption
            $rotations->each(function($rotation) use($container) {
                collect($rotation->corruptions)->each(function($corruption) use($container, $rotation) {
                    if ($corruption === $container->name) {
                        $container->rotation_id = $this->rotationRepo->getWhere('name', $rotation->title)->id;
                        return;
                    }
                });
            });
            // Clean up description string from api
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
