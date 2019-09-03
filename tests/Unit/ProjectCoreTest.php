<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Core\ProjectCore;

class ProjectCoreTest extends TestCase {

    public function testGetProjectIdRange()
    {

        /* As of Friday, August 30, 2019. */
        $LARGEST_CURRENT_PROJECT_ID = 7;
        $SMALLEST_CURRENT_PROJECT_ID = 328;

        $projectIdRange = ProjectCore::getProjectIdRange();
        $smallestProjectIdNumber = $projectIdRange[ 0 ];
        $largetProjectIdNumber = $projectIdRange[ 1 ];

        $this->assertEquals( 7, $smallestProjectIdNumber );
        $this->assertEquals( 328, $largetProjectIdNumber );
        
    }

}