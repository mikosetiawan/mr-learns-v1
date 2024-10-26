@props(['id', 'editButton' => false, 'deleteButton' => false])

<div class="btn-group" role="group">
    @if($editButton)
        <button onclick="openEditModal({{ $id }})" class="edit btn btn-success btn-sm">
            <i class="fas fa-edit"></i> Edit
        </button>
    @endif
    
    @if($deleteButton)
        <button onclick="deleteData({{ $id }})" class="delete btn btn-danger btn-sm ms-1">
            <i class="fas fa-trash"></i> Delete
        </button>
    @endif
</div>