<?php

namespace App\Livewire\Product;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class AddProductModal extends Component
{
    use WithFileUploads;
public $product_id;
    public $product_name;
    public $price;

    public $avatar;
    public $saved_avatar;

    public $edit_mode = false;

    protected $rules = [
        'product_name' => 'required|string',
        'price' => 'required',
        'avatar' => 'nullable|sometimes|image|max:1024'
    ];

    protected $listeners = [
        'delete_product' => 'deleteProduct',
        'update_product' => 'updateProduct',
    ];

    public function render()
    { 
        return view('livewire.Product.add-Product-modal');
    }
  
  
    public function submit()
    { 
        // Validate the form input data
        $this->validate();
    
        DB::transaction(function () {
            if (Auth::check()) {
                // Get the current user's ID
                $userId = Auth::id();
    
                // Prepare the data for creating a new user
                $data = [
                    'name' => $this->product_name,
                    'price' => $this->price,
                    'user_id' => $userId
                ];
    
                // Check if the user has a default role (e.g., 'trial')
                $defaultRole = 'trial';
                $user = User::find($userId);
                $user->assignRole($defaultRole);
    
                if ($this->avatar) {
                    $data['product_image'] = $this->avatar->store('avatars', 'public');
                } else {
                    if (!$this->edit_mode) {
                        $data['product_image'] = null;
                    }
                }
    
                if ($this->edit_mode) {
                    $product = Product::find($this->product_id);
                   
                    // Update product data
                    foreach ($data as $k => $v) {
                        $product->$k = $v;
                    }
        
                    // Save the updated product
                    $product->save();
                    $this->dispatch('success', __('Product Updated'));
                    $this->reset();
                } else {
                    // Create a new product
                    Product::create($data);
                    $this->dispatch('success', __('New Product Created'));
                    $this->reset();
                }
            }
        });
       
    }
   
    public function deleteProduct($id)
    {
        
        // Prevent deletion of current user
        if ($id == Auth::id()) {
            $this->dispatch('error', 'Product cannot be deleted');
            return;
        }

        // Delete the user record with the specified ID
        Product::destroy($id);

        // Emit a success event with a message
        $this->dispatch('success', 'product successfully deleted');
    }

    public function updateProduct($id)
    {
        
        $this->edit_mode = true;

        $product = Product::find($id);
        // dd($product->product_image);
        $this->product_id = $product->id;
        $this->saved_avatar = $product->product_image;
        $this->product_name = $product->name;
        $this->price = $product->price;
    //  dd( $product->product_image);
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }
}
