{{-- @dd($rolePermission) --}}
<div class="hstack gap-5">
    @foreach ($permission as $permissions)
        @if (Str::contains($permissions, $find))

            <div class="form-check pl-5">
                <input class="form-check-input check hemanshi" name="permission" type="checkbox" value="{{$permissions->name}}"
                    id="{{$permissions->id}}"
                    @if($page == 'edit page')
                    {{-- {{dd($rolePermission)}} --}}

                        @foreach ($rolePermission as $role)
                          {{-- {{dd($role)}} --}}
                            {{ $role->name == $permissions->name ? 'checked' : ''}}
                        @endforeach
                    @endif>
                <label class="form-check-label" for="{{ $permissions->id }}">
                    {{ $permissions->name }}
                </label>
            </div>
        @endif
    @endforeach
</div>
