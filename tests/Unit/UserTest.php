<?php

namespace Tests\Unit;

//use PHPUnit\Framework\TestCase;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Facades\Tests\Setup\ProjectFactory;
use Tests\TestCase;
use App\Models\User;

class UserTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function a_user_has_project()
    {
        $user =User::factory()->create();

        $this->assertInstanceOf(Collection::class, $user->projects);
    }
    /** @test */
    public function a_user_has_allProject()
    {
        $user = $this->singIn();

        ProjectFactory::ownedBy($user)->create();

        $this->assertCount(1, $user->allProjects());


        $otherUser = User::factory()->create();
        $anotherOneUser = User::factory()->create();

        $userProject = tap(ProjectFactory::ownedBy($otherUser)->create())->invite($anotherOneUser);
        //$userProject->invite($anotherOneUser);

        $this->assertCount(1, $user->allProjects());

        $userProject->invite($user);

        $this->assertCount(2, $user->allProjects());
    }
}
