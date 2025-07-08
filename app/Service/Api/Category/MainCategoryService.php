<?php
namespace App\Service\Api\Category;

use App\Models\Api\Category\MainCategory;
use Illuminate\Database\Eloquent\Collection;

class MainCategoryService
{
    public function all(): Collection
    {
        return MainCategory::latest()->get();
    }

    public function create(array $data): MainCategory
    {
        return MainCategory::create($data);
    }

    public function update(MainCategory $mainCategory, array $data): MainCategory
    {
        $mainCategory->update($data);
        return $mainCategory;
    }

    public function delete(MainCategory $mainCategory): void
    {
        $mainCategory->delete();
    }
}