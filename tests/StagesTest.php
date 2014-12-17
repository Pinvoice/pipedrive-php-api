<?php

use Pinvoice\Pipedrive\API as PipedriveAPI;

class StagesTest extends PHPUnit_Framework_TestCase
{
    private $pipedrive;
    private $stages;

    /**
     * Set up and test Pipedrive API connection, and get all Stages.
     */
    public function setUp()
    {
        $this->pipedrive = new PipedriveAPI(getenv('PIPEDRIVE_TOKEN'));

        if (!$this->pipedrive->isAuthenticated()) {
            $this->markTestSkipped('Cannot authenticate with Pipedrive.');
        }

        $this->stages = $this->pipedrive->stages->getStages();

        if (is_null($this->stages)) {
            $this->markTestSkipped('There are no Stages available to test with.');
        }
    }

    /**
     * Try to get all Stages.
     */
    public function testCanGetStages()
    {
        $this->pipedrive->stages->getStages();
    }

    /**
     * Try to get Stage by ID.
     */
    public function testCanGetSingleStage()
    {
        $firstStageInStages = $this->stages[0];
        $stageByFirstStageId = $this->pipedrive->stages->getStage($firstStageInStages->id);

        $this->assertEquals($firstStageInStages->add_time, $stageByFirstStageId->add_time);
    }

    /**
     * Try to get Stage by Pipeline ID.
     */
    public function testCanGetStagesByPipelineId()
    {
        $firstPipeline = $this->pipedrive->pipelines->getPipelines()[0];
        $this->pipedrive->stages->getStagesByPipelineId($firstPipeline->id);
    }

}
