<div>
    <form wire:submit.prevent="update()" enctype="multipart/form-data">
        <div>
            @if(session()->has('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
        </div>
        <div class="form-group mb-3">
            <label for="categoryDescription">Nick:</label>
            <input type="text" class="form-control @error('nick') is-invalid @enderror" id="categoryName" placeholder="Enter Name" wire:model.defer="nick">
            
            @error('nick') <span class="text-danger">{{ $message }}</span>@enderror
        </div>        
        <div class="form-group mb-3">
            <label for="categoryName">Name:</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="categoryName" placeholder="Enter Name" wire:model.defer="name">
            @error('name') <span class="text-danger">{{ $message }}</span>@enderror
        </div>

        <div class="form-group">
            <input type="file" class="form-control" wire:model="profile_image">
            @error('profile_image') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <input type="file" class="form-control" wire:model="nick_image">
            @error('nick_image') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        

        <div class="d-grid gap-2">
            <button type="submit">Save Photo</button>
            {{-- <button wire:click.prevent="update()" class="btn btn-success btn-block">Save</button>
            <button wire:click.prevent="cancel()" class="btn btn-danger">Cancel</button> --}}
        </div>
    </form>
</div>
