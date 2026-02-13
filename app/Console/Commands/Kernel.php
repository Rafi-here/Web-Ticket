protected function schedule(Schedule $schedule)
{
$schedule->command('tickets:expire')->everyMinute(); // untuk development
// $schedule->command('tickets:expire')->everyFiveMinutes(); // untuk production
}