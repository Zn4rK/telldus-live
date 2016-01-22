<?php namespace Paxx\Telldus\Api;

use Paxx\Telldus\Exception\ApiException;

class Scheduler extends BaseApi
{
    /**
     * Retrieves info about a specific job
     *
     * @param $jobId - The job id
     * @return mixed
     */
    public function jobInfo($jobId)
    {
        return $this->request('scheduler/jobInfo', array(
            'id' => $jobId
        ));
    }

    /**
     * Lists all jobs. The list is sorted by nextRunTime. If nextRunTime is 0 it means the job will not be run at all.
     *
     * @return mixed
     */
    public function jobList()
    {
        $response = $this->request('scheduler/jobList');
        return $response['job'];
    }

    /**
     * Removes a job
     *
     * @param $jobId - The job id
     * @return mixed
     */
    public function removeJob($jobId)
    {
        return $this->request('scheduler/removeJob', array(
            'id' => $jobId
        ));
    }

    /**
     * Creates or updates a job. Set id to null if you want to create a new job.
     * If you are creating a new job the deviceId must also be set.
     * The deviceId can only be set upon creating a new job.
     * When updating an existing job the deviceId parameter must be omitted.
     *
     * @see http://api.telldus.com/explore/scheduler/setJob for parameters in $options
     */
    public function setJob($id=null, $deviceId=null, $options)
    {
        if($id === null) {
            $id = 0;

            if($deviceId === null) {
                throw new ApiException("The Device ID must be specified if no Job ID is specified");
            }
        }

        $params = array(
            'id' => $id,
            'deviceId' => $deviceId
        );

        // We don't want id and deviceId in the options
        unset($options['id'], $options['deviceId']);

        // Merge the two arrays
        $params = array_merge($params, $options);

        return $this->request('scheduler/setJob', $params);
    }
}