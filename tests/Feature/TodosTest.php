<?php

namespace Tests\Feature;

use App\Models\Item;
use App\Models\User;
use Tests\TestCase;

class TodosTest extends TestCase
{

    protected function setUp(): void
    {
        parent::setUp();
        $user = User::factory()->create();
        $this->actingAs($user);
    }

    public function test_users_can_add_new_item(){
        $item = Item::factory()->make(['user_id' => auth()->id()]);
        $this->post(route('todo.store'),$item->toArray());
        $this->assertDatabaseHas('items',['name' => $item->name]);
    }

    public function test_users_can_mark_items_as_complete(){
        $item = Item::factory()->create(['user_id' => auth()->id()]);
        $this->post(route('todo.complete'),['id' => $item->id]);
        $this->assertDatabaseHas('items',['name' => $item->name]);
        $itemData = Item::findOrFail($item->id);
        $this->assertNotNull($itemData->completed_at);
    }

    public function test_users_can_delete_their_items(){
        $item = Item::factory()->create(['user_id' => auth()->id()]);
        $this->post(route('todo.delete'),['id' => $item->id]);
        $itemData = Item::withTrashed()->findOrFail($item->id);
        $this->assertNotNull($itemData->deleted_at);
    }
}
