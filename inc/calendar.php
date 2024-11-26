<?php
class Calendar
{
    private $active_year, $active_month, $active_day;
    private $events = [];

    public function __construct($date = null)
    {
        $this->active_year = $date ? date('Y', strtotime($date)) : date('Y');
        $this->active_month = $date ? date('m', strtotime($date)) : date('m');
        $this->active_day = $date ? date('d', strtotime($date)) : date('d');
    }

    // Modificación para asegurar que los eventos se registren por fecha
    public function add_event($txt, $date, $days = 1, $post_id = null)
    {
        $formatted_date = date('Y-m-d', strtotime($date));
        $this->events[$formatted_date][] = [$txt, $days, 'gold', $post_id];
    }

    public function __toString()
    {
        $num_days = date('t', strtotime($this->active_year . '-' . $this->active_month));
        $days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
        $first_day_of_week = date('w', strtotime($this->active_year . '-' . $this->active_month . '-1'));

        $html = '<div class="calendar bg-dark text-light p-4 rounded">';
        $html .= '<div class="header text-center mb-4"><h3 class="text-gold">' . date('F Y', strtotime($this->active_year . '-' . $this->active_month)) . '</h3></div>';
        $html .= '<div class="days d-flex justify-content-between">';
        foreach ($days as $day) {
            $html .= '<div class="day_name text-center py-2 text-light">' . $day . '</div>';
        }
        $html .= '</div><div class="days-numbers d-flex flex-wrap">';

        for ($i = 0; $i < $first_day_of_week; $i++) {
            $html .= '<div class="day_num ignore text-muted p-2 text-center"></div>';
        }

        for ($i = 1; $i <= $num_days; $i++) {
            $current_date = date('Y-m-d', strtotime($this->active_year . '-' . $this->active_month . '-' . $i));
            $html .= '<div class="day_num p-2 text-center"><span class="date-number">' . $i . '</span>';

            if (isset($this->events[$current_date])) {
                foreach ($this->events[$current_date] as $event) {
                    $html .= '<div class="event bg-' . $event[2] . ' p-1 mt-2 text-center rounded" data-bs-toggle="modal" data-bs-target="#modal_' . $event[3] . '">';
                    $html .= $event[0];
                    $html .= '</div>';
                }
            }

            $html .= '</div>';
        }

        $html .= '</div></div>';
        return $html;
    }
}
