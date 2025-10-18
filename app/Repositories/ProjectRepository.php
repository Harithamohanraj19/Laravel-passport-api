<?php


namespace App\Repositories;


use App\Models\Project;


class ProjectRepository
{
public function getAllForUser($userId, $perPage = 10, $filters = [])
{
$query = Project::where('user_id', $userId);


if (isset($filters['search'])) {
$query->where('title', 'like', '%'.$filters['search'].'%');
}


if (isset($filters['is_active'])) {
$query->where('is_active', $filters['is_active']);
}


return $query->orderBy('created_at', 'desc')->paginate($perPage);
}


public function findById($id)
{
return Project::findOrFail($id);
}


public function create(array $data)
{
return Project::create($data);
}


public function update(Project $project, array $data)
{
$project->update($data);
return $project;
}


public function delete(Project $project)
{
return $project->delete();
}
}