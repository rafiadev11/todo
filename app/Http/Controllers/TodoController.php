<?php

    namespace App\Http\Controllers;

    use App\Models\Item;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Log;

    class TodoController extends Controller
    {
        /**
         * @var Item
         */
        private $item;

        /**
         * @param  Item  $item
         */
        public function __construct(Item $item)
        {
            $this->item = $item;
        }

        public function index()
        {
            return view('todo.index');
        }

        public function store(Request $request)
        {
            $this->validate($request, [
                'name' => 'required',
            ]);
            return $this->item->create($request->all());
        }
    }
