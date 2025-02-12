<?php

namespace JfelixStudio\Analytics\Tests;

use Carbon\Carbon;
use DateTimeImmutable;
use JfelixStudio\Analytics\Exceptions\InvalidPeriod;
use JfelixStudio\Analytics\Period;
use PHPUnit\Framework\TestCase;

class PeriodTest extends TestCase
{
    /** @test */
    public function it_can_create_a_period_for_a_given_amount_of_days()
    {
        Carbon::setTestNow(Carbon::create(2016, 1, 1));

        $period = Period::days(10);

        $this->assertSame('2015-12-22', $period->startDate->format('Y-m-d'));
        $this->assertSame('2016-01-01', $period->endDate->format('Y-m-d'));
    }

    /** @test */
    public function it_can_create_a_period_for_a_given_amount_of_months()
    {
        Carbon::setTestNow(Carbon::create(2016, 1, 10));

        $period = Period::months(10);

        $this->assertSame('2015-03-10', $period->startDate->format('Y-m-d'));
        $this->assertSame('2016-01-10', $period->endDate->format('Y-m-d'));
    }

    /** @test */
    public function it_can_create_a_period_for_a_given_amount_of_years()
    {
        Carbon::setTestNow(Carbon::create(2016, 1, 12));

        $period = Period::years(2);

        $this->assertSame('2014-01-12', $period->startDate->format('Y-m-d'));
        $this->assertSame('2016-01-12', $period->endDate->format('Y-m-d'));
    }

    /** @test */
    public function it_provides_a_create_method()
    {
        $startDate = Carbon::create(2015, 12, 22);
        $endDate = Carbon::create(2016, 1, 1);

        $period = Period::create($startDate, $endDate);

        $this->assertSame('2015-12-22', $period->startDate->format('Y-m-d'));
        $this->assertSame('2016-01-01', $period->endDate->format('Y-m-d'));
    }

    /** @test */
    public function it_accepts_datetime_immutable_instances()
    {
        $startDate = Carbon::create(2015, 12, 22)->toIso8601String();
        $startDateImmutable = new DateTimeImmutable($startDate);
        $endDate = Carbon::create(2016, 1, 1)->toIso8601String();
        $endDateImmutable = new DateTimeImmutable($endDate);

        $period = Period::create($startDateImmutable, $endDateImmutable);

        $this->assertSame('2015-12-22', $period->startDate->format('Y-m-d'));
        $this->assertSame('2016-01-01', $period->endDate->format('Y-m-d'));
    }

    /** @test */
    public function it_will_throw_an_exception_if_the_start_date_comes_after_the_end_date()
    {
        $startDate = Carbon::create(2016, 1, 1);
        $endDate = Carbon::create(2015, 1, 1);

        $this->expectException(InvalidPeriod::class);

        Period::create($startDate, $endDate);
    }
}
