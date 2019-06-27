<?php

namespace App\Helpers;

use Modules\Comments\Entities\Comment;
use Modules\Leads\Entities\Lead;
use Modules\Tickets\Entities\Ticket;
use Modules\Timetracking\Entities\TimeEntry;

class Report
{
    public function invoicedByMonth($month, $year)
    {
        return (float) getCalculated('invoiced_' . $month . '_' . $year);
    }

    public function dealsByMonth($month, $year, $status = null)
    {
        if ($status === 'won') {
            return (float) getCalculated('deals_won_' . $month . '_' . $year);
        }
        if ($status === 'lost') {
            return (float) getCalculated('deals_lost_' . $month . '_' . $year);
        }
        return (float) getCalculated('deals_' . $month . '_' . $year);
    }
    public function dealsByStage($id)
    {
        return (float) getCalculated('deals_stage_' . $id);
    }

    public function expensesByMonth($month, $year, $status = null)
    {
        if ($status === 'billed') {
            return (float) getCalculated('expenses_billed_' . $month . '_' . $year);
        }
        if ($status === 'billable') {
            return (float) getCalculated('expenses_billable_' . $month . '_' . $year);
        }
        return (float) getCalculated('expenses_' . $month . '_' . $year);
    }

    public function paymentsByMonth($month, $year)
    {
        return (float) getCalculated('payments_' . $month . '_' . $year);
    }

    public function repliesByMonth($month, $year)
    {
        return (int) getCalculated('ticket_replies_' . $month . '_' . $year);
    }

    public function ticketsByMonth($month, $year, $status = null)
    {
        if ($status === 'open') {
            return (int) getCalculated('tickets_pending_' . $month . '_' . $year);
        }
        if ($status === 'closed') {
            return (int) getCalculated('tickets_closed_' . $month . '_' . $year);
        }
        return (int) getCalculated('tickets_' . $month . '_' . $year);
    }

    public function ticketsByDept($dept)
    {
        return getCalculated('tickets_dept_' . $dept);
    }

    public function feedback($rating)
    {
        if ($rating) {
            return (int) getCalculated('feedback_great');
        }
        return (int) getCalculated('feedback_bad');
    }

    public function doneProjectsByMonth($month, $year)
    {
        return (int) getCalculated('projects_done_' . $month . '_' . $year);
    }

    public function doneTasksByMonth($month, $year)
    {
        return (int) getCalculated('tasks_done_' . $month . '_' . $year);
    }

    public function closedIssuesByMonth($month, $year)
    {
        return (int) getCalculated('issues_closed_' . $month . '_' . $year);
    }

    public function openTasksPercent()
    {
        return (float) getCalculated('tasks_open_percent');
    }

    public function closedTasksPercent()
    {
        return (float) getCalculated('tasks_closed_percent');
    }

    public function tasksByMonth($month, $year, $status = 'active')
    {
        if ($status === 'overdue') {
            return (int) getCalculated('tasks_overdue_' . $month . '_' . $year);
        }
        return (int) getCalculated('tasks_active_' . $month . '_' . $year);
    }
    public function workedByMonth($month, $year, $status = null)
    {
        if ($status === 'billed') {
            return (int) getCalculated('time_worked_billed_' . $month . '_' . $year);
        }
        return (int) getCalculated('time_worked_' . $month . '_' . $year);
    }

    public function openIssuesPercent()
    {
        return (float) getCalculated('issues_open_percent');
    }

    public function closedIssuesPercent()
    {
        return (float) getCalculated('issues_closed_percent');
    }
    public function activeProjectsPercent()
    {
        return (float) getCalculated('projects_active_percent');
    }

    public function doneProjectsPercent()
    {
        return (float) getCalculated('projects_done_percent');
    }

    public function billablePercent()
    {
        return (float) getCalculated('billable_percent');
    }
    public function unbillablePercent()
    {
        return (float) getCalculated('unbillable_percent');
    }
    public function leadsByMonth($month, $year, $status = 'all')
    {
        if ($status === 'converted') {
            return (int) getCalculated('leads_converted_' . $month . '_' . $year);
        }
        return (int) getCalculated('leads_' . $month . '_' . $year);
    }
    public function estimatesByMonth($month, $year, $status = 'accepted')
    {
        if ($status === 'rejected') {
            return (int) getCalculated('estimates_rejected_' . $month . '_' . $year);
        }
        if ($status === 'accepted') {
            return (int) getCalculated('estimates_accepted_' . $month . '_' . $year);
        }
        return (int) getCalculated('estimates_' . $month . '_' . $year);
    }
    public function creditsByMonth($month, $year, $status = 'all')
    {
        if ($status === 'closed') {
            return (float) getCalculated('credits_closed_' . $month . '_' . $year);
        }
        return (float) getCalculated('credits_' . $month . '_' . $year);
    }
    public function numTicketsByDay($day)
    {
        $date = dateParser($day)->toDateString();
        return Ticket::whereDate('created_at', $date)->count();
    }
    public function numLeadsByDay($day)
    {
        $date = dateParser($day)->toDateString();
        return Lead::whereDate('created_at', $date)->count();
    }
    public function workedByDay($day, $user)
    {
        $date = dateParser($day)->toDateString();
        return round(TimeEntry::where('user_id', $user)->whereDate('created_at', $date)->sum('total') / 3600);
    }
    public function ticketRepliesByDay($day)
    {
        $date = dateParser($day)->toDateString();
        return Comment::whereModule('tickets')->whereDate('date_posted', $date)->count();
    }
}
