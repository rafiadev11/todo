<?php

    namespace App\Http\Controllers;

    use App\Models\Item;
    use Carbon\Carbon;
    use Illuminate\Database\Eloquent\Collection;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Log;
    use Illuminate\Validation\ValidationException;
    use Illuminate\View\View;

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

        /**
         * get the user's to do view
         *
         * @return View
         */
        public function index():View
        {
            return view('todo.index');
        }


        /**
         * get authenticated user's items
         *
         * @return Collection
         */
        public function getItems(): Collection
        {
            return $this->item
                ->where('user_id', auth()->id())
                ->orderBy('id', 'DESC')
                ->get();
        }

        /**
         * Add a new item to the user's to do list
         *
         * @param  Request  $request
         *
         * @return Item
         * @throws ValidationException
         */
        public function store(Request $request): Item
        {
            $this->validate($request, [
                'name' => 'required',
            ]);
            return $this->item->create($request->all());
        }

        /**
         * Mark a user's item as complete
         *
         * @param  Request  $request
         *
         * @return Item
         * @throws ValidationException
         */
        public function markAsComplete(Request $request):Item
        {
            $this->validate($request, [
                'id' => 'required|integer',
            ]);
            return $this->item->complete($request->get('id'));
        }

        /**
         * Soft delete a user's item
         *
         * @param  Request  $request
         *
         * @throws ValidationException
         */
        public function deleteItem(Request $request):void
        {
            $this->validate($request, [
                'id' => 'required|integer',
            ]);
            $this->item
                ->findOrFail($request->get('id'))
                ->delete();
        }
    }
