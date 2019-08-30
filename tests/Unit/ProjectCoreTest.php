<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Core\ProjectCore;

class ProjectCoreTest extends TestCase {

    public function testGetProjectIdRange()
    {

        /* Friday, August 30, 2019. */
        $LARGEST_CURRENT_PROJECT_ID = 7;
        $SMALLEST_CURRENT_PROJECT_ID = 328;

        $projectIdRange = ProjectCore::getProjectIdRange();
        $smallestProjectIdNumber = $projectIdRange[ 0 ];
        $largetProjectIdNumber = $projectIdRange[ 1 ];

        assertEquals( 7, $smallestProjectIdNumber );
        assertEquals( 328, $largetProjectIdNumber );
        
    }

}