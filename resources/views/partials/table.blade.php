<table id="projects-table" class="table table-dark table-hover shadow mb-2 mt-3 hype-unselectable hype-table-clickable">
    <thead>
        <tr>
            <th scope="col">#id Project</th>
            <th scope="col">Project Title</th>
            <th scope="col" class="d-none d-xl-table-cell">Created at</th>
            <th scope="col" class="d-none d-lg-table-cell">Type</th>
            <th scope="col" class="d-none d-lg-table-cell">Techonlogies</th>
            <th scope="col"
                class=" {{ Route::currentRouteName() === 'admin.projects.index' ? '' : 'd-none' }} text-center">
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
                        @if ($element->type)
                            {{ $element->type->name }}
                        @else
                            Nessun tipo
                        @endif
                    </a></td>
                <td class="d-none d-lg-table-cell">
                    @if ($element->technologies)
                        <div class="d-flex align-items-center my-3 gap-3 ms-2">
                            @foreach ($element->technologies as $technology)
                                <i class="{{ $technology->icon }} fs-3 hype-text-shadow position-relative"
                                    style="color: {{ $technology->color }};">
                                </i>
                            @endforeach
                        </div>
                    @else
                        <h6>No Technology</h6>
                    @endif
                </td>
                <td class=" {{ Route::currentRouteName() === 'admin.projects.index' ? '' : 'd-none' }}">
                    <div class="d-flex justify-content-center">
                        <a href="{{ route('admin.projects.show', $element->slug) }}" class="table-icon m-1">
                            <div class="icon-container">
                                <i
                                    class=" fa-solid fa-eye fs-3 text-active-tertiary hype-text-shadow hype-hover-size"></i>
                            </div>
                        </a>
                        <a href="{{ route('admin.projects.edit', $element->slug) }}" class="table-icon m-1">
                            <div class="icon-container">
                                <i
                                    class=" fa-solid fa-pen-to-square fs-3 text-active-tertiary hype-text-shadow hype-hover-size"></i>
                            </div>
                        </a>
                        <form id="delete-form" action="{{ route('admin.projects.destroy', $element->slug) }}"
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
