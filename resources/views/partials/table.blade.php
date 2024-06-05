<table id="projects-table" class="table table-dark table-hover shadow mb-2 mt-3 hype-unselectable hype-table-clickable">
    <thead>
        <tr>
            <th scope="col">#id Project</th>
            <th scope="col">Project Title</th>
            <th scope="col" class="d-none d-xl-table-cell">Created at</th>
            <th scope="col" class="d-none d-lg-table-cell">Categories</th>
            <th scope="col" class="d-none d-lg-table-cell">Techonlogies</th>
            <th scope="col" class=" {{ Route::currentRouteName() === 'admin.projects.index' ? '' : 'd-none' }}">
                Amministration Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($elements as $element)
            <tr>
                <td><a>{{ $element->id }} </a></td>
                <td><a>{{ $element->title }}</a></td>
                <td class="d-none d-xl-table-cell"><a>{{ $element->created }}</a></td>
                <td class="d-none d-lg-table-cell"><a>
                        @if ($element->category)
                            {{ $element->category->name }}
                        @else
                            Nessuna categoria
                        @endif
                    </a></td>
                <td class="d-none d-lg-table-cell"><a>{{ $element->technologies }}</a>
                </td>
                <td class=" {{ Route::currentRouteName() === 'admin.projects.index' ? '' : 'd-none' }}">
                    <div class="d-flex justify-content-center">
                        <a href="{{ route('admin.projects.show', $element) }}" class="table-icon m-1">
                            <div class="icon-container">
                                <i
                                    class=" fa-solid fa-eye fs-3 text-active-tertiary hype-text-shadow hype-hover-size"></i>
                            </div>
                        </a>
                        <a href="{{ route('admin.projects.edit', $element) }}" class="table-icon m-1">
                            <div class="icon-container">
                                <i
                                    class=" fa-solid fa-pen-to-square fs-3 text-active-tertiary hype-text-shadow hype-hover-size"></i>
                            </div>
                        </a>
                        <form id="delete-form" action="{{ route('admin.projects.destroy', $element->id) }}"
                            method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="element-delete default-button text-active-primary hype-text-shadow fs-3 m-1"
                                type="submit" data-element-id="{{ $element->id }}"
                                data-element-title="{{ $element->title }}">
                                <div class="icon-container">
                                    <i class="fa-solid fa-trash-can "></i>
                                </div>
                            </button>
                        </form>
                    </div>

                </td>
            </tr>
        @endforeach
    </tbody>
</table>
