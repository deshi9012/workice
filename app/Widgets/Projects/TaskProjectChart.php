<?php

namespace App\Widgets\Projects;

use Arrilot\Widgets\AbstractWidget;

class TaskProjectChart extends AbstractWidget
{

    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $year = chartYear();

        $metrics = new \App\Helpers\Report;

        $projects = [
            'jan' => $metrics->doneProjectsByMonth(1, $year),
            'feb' => $metrics->doneProjectsByMonth(2, $year),
            'mar' => $metrics->doneProjectsByMonth(3, $year),
            'apr' => $metrics->doneProjectsByMonth(4, $year),
            'may' => $metrics->doneProjectsByMonth(5, $year),
            'jun' => $metrics->doneProjectsByMonth(6, $year),
            'jul' => $metrics->doneProjectsByMonth(7, $year),
            'aug' => $metrics->doneProjectsByMonth(8, $year),
            'sep' => $metrics->doneProjectsByMonth(9, $year),
            'oct' => $metrics->doneProjectsByMonth(10, $year),
            'nov' => $metrics->doneProjectsByMonth(11, $year),
            'dec' => $metrics->doneProjectsByMonth(12, $year),
        ];
        $tasks = [
            'jan' => $metrics->doneTasksByMonth(1, $year),
            'feb' => $metrics->doneTasksByMonth(2, $year),
            'mar' => $metrics->doneTasksByMonth(3, $year),
            'apr' => $metrics->doneTasksByMonth(4, $year),
            'may' => $metrics->doneTasksByMonth(5, $year),
            'jun' => $metrics->doneTasksByMonth(6, $year),
            'jul' => $metrics->doneTasksByMonth(7, $year),
            'aug' => $metrics->doneTasksByMonth(8, $year),
            'sep' => $metrics->doneTasksByMonth(9, $year),
            'oct' => $metrics->doneTasksByMonth(10, $year),
            'nov' => $metrics->doneTasksByMonth(11, $year),
            'dec' => $metrics->doneTasksByMonth(12, $year),
        ];

        $issues = [
            'jan' => $metrics->closedIssuesByMonth(1, $year),
            'feb' => $metrics->closedIssuesByMonth(2, $year),
            'mar' => $metrics->closedIssuesByMonth(3, $year),
            'apr' => $metrics->closedIssuesByMonth(4, $year),
            'may' => $metrics->closedIssuesByMonth(5, $year),
            'jun' => $metrics->closedIssuesByMonth(6, $year),
            'jul' => $metrics->closedIssuesByMonth(7, $year),
            'aug' => $metrics->closedIssuesByMonth(8, $year),
            'sep' => $metrics->closedIssuesByMonth(9, $year),
            'oct' => $metrics->closedIssuesByMonth(10, $year),
            'nov' => $metrics->closedIssuesByMonth(11, $year),
            'dec' => $metrics->closedIssuesByMonth(12, $year),
        ];

        return view(
            'widgets.projects.task_project_chart', [
            'config'   => $this->config,
            'year'     => $year,
            'projects' => $projects,
            'tasks'    => $tasks,
            'issues'     => $issues,
            ]
        );
    }
}
