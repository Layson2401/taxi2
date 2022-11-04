<?php

namespace App\Http;

use App\JourneyType;
use App\Core\View\View;
use App\JourneyTypeRepository;

class JourneyTypeController
{
    public function all() //array
    {
        $journeyTypeRepository = new JourneyTypeRepository();
        $journeyTypes = $journeyTypeRepository->all();

        return View::render('journeyTypes/index', [
            'journeyTypes' => $journeyTypes
        ]);
        //return $journeyTypes;
    }

    public function add()
    {
        $newJourneyType = new JourneyType(null, 'Comfort');
        $journeyTypeRepository = new JourneyTypeRepository();
        $journeyTypeRepository->add($newJourneyType);
    }

    public function update(int $id)
    {
        $updatedUser = new JourneyType(null, 'Business');
        $journeyTypeRepository = new JourneyTypeRepository();
        $journeyTypeRepository->update($id, $updatedUser);
    }

    public function delete(int $id)
    {
        $journeyTypeRepository = new JourneyTypeRepository();
        $journeyTypeRepository->delete($id);
    }
}