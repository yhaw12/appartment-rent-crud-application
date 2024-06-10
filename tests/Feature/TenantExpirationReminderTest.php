<?php

namespace Tests\Feature;

use App\Mail\RentExpirationReminder;
use App\Models\Tennants;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Event;
use Illuminate\Console\Scheduling\Schedule;
use Mail;
use Tests\TestCase;

class TenantExpirationReminderTest extends TestCase
{
    public function test_rent_expiration_reminder_is_sent_three_months_before_expiration()
{
    // Create a tenant with a rent expiration date three months from now
    $tenant = Tennants::factory()->create([
        'end_date' => Carbon::now()->addMonths(3),
    ]);

    // Simulate the passage of time to three months before the rent expiration date
    Carbon::setTestNow(Carbon::parse($tenant->end_date)->subMonths(3));

    // Run the Laravel task scheduler
    $this->artisan('schedule:run');

    // Assert that a rent expiration reminder email was sent to the tenant
    Mail::assertSent(RentExpirationReminder::class, function ($mail) use ($tenant) {
        return $mail->tenant->id === $tenant->id;
    });
}
}
