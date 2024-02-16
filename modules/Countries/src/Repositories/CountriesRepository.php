<?php

namespace Modules\Countries\src\Repositories;

use App\Models\Countries;
use App\Repositories\BaseRepository;
use Modules\Countries\src\Models\Country;
use Modules\Countries\src\Repositories\CountriesRepositoryInterface;


class CountriesRepository extends BaseRepository implements CountriesRepositoryInterface
{
  public function getModel()
  {
    return Country::class;
  }
}
