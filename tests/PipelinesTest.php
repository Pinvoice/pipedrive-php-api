<?php

use Pinvoice\Pipedrive\API as PipedriveAPI;

class PipelinesTest extends PHPUnit_Framework_TestCase
{
    private $pipedrive;
    private $pipelines;

    /**
     * Set up and test Pipedrive API connection, and get all Deals.
     */
    public function setUp()
    {
        $this->pipedrive = new PipedriveAPI(getenv('PIPEDRIVE_TOKEN'));

        if (!$this->pipedrive->isAuthenticated()) {
            $this->markTestSkipped('Cannot authenticate with Pipedrive.');
        }

        $this->pipelines = $this->pipedrive->pipelines->getPipelines();

        if (is_null($this->pipelines)) {
            $this->markTestSkipped('There are no Pipelines available to test with.');
        }
    }

    /**
     * Try to get all Pipelines.
     */
    public function getCanGetPipelines()
    {
        $this->pipedrive->pipelines->getPipelines();
    }

    /**
     * Try to get single Pipeline.
     */
    public function testCanGetSinglePipeline()
    {
        // Try to get the first Pipeline and compare the add_time.
        $firstPipeline = $this->pipelines[0];
        $pipelineByFirstPipeline = $this->pipedrive->pipelines->getPipeline($firstPipeline->id);

        $this->assertEquals($firstPipeline->add_time, $pipelineByFirstPipeline->add_time);
    }
}
