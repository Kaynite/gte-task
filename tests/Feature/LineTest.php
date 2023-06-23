<?php

namespace Tests\Feature;

use App\Models\Line;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Tests\TestCase;

class LineTest extends TestCase
{
    use LazilyRefreshDatabase;

    public function test_it_lists_all_available_lines(): void
    {
        $this->getJson(route('lines.index'))
            ->assertOk()
            ->assertJsonStructure([
                'data' => [],
            ]);
    }

    public function test_it_stores_lines()
    {
        $data = Line::factory()->raw();

        $response = $this->postJson(route('lines.store', $data))
            ->assertCreated();

        $this->assertDatabaseHas(Line::class, [
            'id' => $response->json('data.id'),
            ...$data,
        ]);
    }

    public function test_it_returns_a_single_line()
    {
        $this->getJson(route('lines.show', Line::factory()->create()))
            ->assertOk()
            ->assertJsonStructure([
                'data' => ['id', 'name', 'short_name'],
            ]);
    }

    public function test_it_updates_single_line()
    {
        $line = Line::factory()->create();
        $data = Line::factory()->raw();

        $this->putJson(route('lines.show', $line), $data)
            ->assertOk();

        $this->assertDatabaseHas(Line::class, [
            'id' => $line->id,
            'name' => $data['name'],
            'short_name' => $data['short_name'],
        ]);
    }

    public function test_it_deletes_single_line()
    {
        $line = Line::factory()->create();

        $this->deleteJson(route('lines.show', $line))
            ->assertNoContent();

        $this->assertDatabaseMissing(Line::class, [
            'id' => $line->id,
        ]);
    }
}
