<div>
    <div class="flex flex-col items-start justify-center lg:flex-row">
        <div class="contentLeft">
            <div class="card w-96 bg-base-100">
                <figure class="px-10 pt-10">
                    <img src="https://daisyui.com/images/stock/photo-1534528741775-53994a69daeb.jpg" alt="Shoes"
                        class="rounded-xl" />
                </figure>
                <div class="items-center text-center card-body">
                    <label class="flex items-center gap-2 input input-bordered">
                        Name
                        <input type="text" class="grow" value="{{ ucwords($user->name) }}" readonly />
                    </label>
                    <label class="flex items-center gap-2 input input-bordered">
                        Email
                        <input type="text" class="grow" value="{{ $user->email }}" readonly />
                    </label>
                </div>
            </div>
        </div>
        <div class="w-full p-10 contentRight">
            <div class="flex flex-row justify-between mb-5">
                <h1 class="text-2xl font-bold ">Your Skills</h1>
                <button class="btn btn-primary btn-md" wire:click='$emit("addSkillState", true)' type="button">
                    <span><svg width="20px" height="20px" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M4 12H20M12 4V20" stroke="#fff" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg></span>
                    Add Skills
                </button>
            </div>
            <div class="overflow-x-auto">
                <table class="table table-lg">
                    <!-- head -->
                    <thead>
                        <tr class="text-base text-white bg-success">
                            <th>No</th>
                            <th>Nama Skill</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        <!-- row 1 -->
                        @php
                            $no = 1;
                        @endphp
                        @foreach (\App\Utils\Utils::convertToStdClass($mySkills) as $mySkill)
                            {{-- @dd($mySkills) --}}
                            <tr>
                                <th>{{ $no++ }}</th>
                                <td>{{ $mySkill->nama_skill }}</td>
                                <td>
                                    <button class="text-white btn btn-error btn-sm"
                                        onclick="window.askBeforeExecution('Yakin Hapus Skill ?', () => window.Livewire.emit('deleteSkill', {{ $mySkill->id }}))">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
    @if ($addSkill)
        @livewire('add-skill')
    @endif
    <script>
        document.addEventListener("livewire:load", () => {
            window.Livewire.on('skillDeleted', (data) => {
                const dataOriginal = data.original
                if (dataOriginal.httpCode == 200) {
                    Swal.fire({
                        icon: 'success',
                        text: dataOriginal.message
                    })
                }
            })

        })
    </script>
</div>
