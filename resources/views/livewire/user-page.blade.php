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
            <div class="flex flex-row justify-between">
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
            <div class="total">
                <div class="information">
                    <h2>Per Page Pagination:
                        {{ !is_array($mySkills) && method_exists($mySkills, 'hasPages') ? $mySkills->perPage() : '' }}
                    </h2>
                    <h2>Total My Skill:
                        {{ !is_array($mySkills) && method_exists($mySkills, 'hasPages') ? $mySkills->total() : '' }}
                    </h2>
                </div>
            </div>
            <div class="flex flex-col items-end justify-between h-full my-5 lg:flex-row">
                <div class="filter">
                    <label class="w-full max-w-xs form-control">
                        <div class="label">
                            <span class="label-text">Filter</span>
                        </div>
                        <select class="select select-bordered" wire:model="filterValue">
                            <option disabled selected value="null">Pick one</option>
                            <option value="latest">Terbaru</option>
                            <option value="oldest">Terlama</option>
                        </select>
                    </label>
                </div>
                {{-- <div class="search">
                    <label class="flex items-center justify-center gap-2 input input-bordered">
                        <input type="text" class="grow" placeholder="Search"
                            wire:model.debounce.200ms="searchValue" />
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                            class="w-4 h-4 opacity-70">
                            <path fill-rule="evenodd"
                                d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z"
                                clip-rule="evenodd" />
                        </svg>
                    </label>
                </div> --}}
            </div>
            <p>{{ $searchValue }}</p>
            <div class="overflow-x-auto">
                <table class="table table-lg" id="tableSkills">
                    <!-- head -->
                    <thead>
                        <tr class="text-base text-white bg-success">
                            <th>No</th>
                            <th>Nama Skill</th>
                            <th>Keterangan</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        <!-- row 1 -->
                        @php
                            $no = 1;
                        @endphp
                        @if ($mySkills != null)
                            @foreach ($mySkills as $mySkill)
                                {{-- @dd($mySkill->skills_user_description->description) --}}
                                <tr class="">
                                    <th>{{ $no++ }}</th>
                                    <td>{{ $mySkill->skills_model->nama_skill ?? '' }}</td>
                                    <td>{{ $mySkill->skills_user_description->description }}</td>
                                    <td class="flex flex-col gap-2 lg:flex-row">
                                        <button class="text-white btn btn-error btn-sm"
                                            onclick="window.askBeforeExecution('Yakin Hapus Skill ?', () => window.Livewire.emit('deleteSkill', {{ $mySkill->id }}))">Delete</button>
                                        <button class="text-white btn btn-primary btn-sm"
                                            wire:click="$emit('editSkillState',true, {{ $mySkill->id }})">Edit</button>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4" class="text-center">No Data</td>
                            </tr>
                        @endif
                    </tbody>
                </table>

            </div>
            @if (!is_array($mySkills) && method_exists($mySkills, 'hasPages'))
                <div class="h-12 mx-auto my-auto mt-20 overflow-hidden shadow-lg w-52 rounded-3xl">
                    <div class="flex flex-row items-center justify-between w-full h-full gap-2">
                        <div
                            class="flex items-center justify-center w-full h-full mx-auto btnNextPaginate hover:bg-slate-200">
                            @if ($mySkills->onLastPage() || !$mySkills->onFirstPage())
                                <a href="{{ $mySkills->previousPageUrl() }}">
                                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none"
                                        class="rotate-180" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M9.71069 18.2929C10.1012 18.6834 10.7344 18.6834 11.1249 18.2929L16.0123 13.4006C16.7927 12.6195 16.7924 11.3537 16.0117 10.5729L11.1213 5.68254C10.7308 5.29202 10.0976 5.29202 9.70708 5.68254C9.31655 6.07307 9.31655 6.70623 9.70708 7.09676L13.8927 11.2824C14.2833 11.6729 14.2833 12.3061 13.8927 12.6966L9.71069 16.8787C9.32016 17.2692 9.32016 17.9023 9.71069 18.2929Z"
                                            fill="#0F0F0F" />
                                    </svg>
                                </a>
                            @endif
                        </div>
                        <div class="flex-none p-1 border-black totalPage">
                            <span>Page {{ $mySkills->currentPage() }}</span>
                        </div>
                        <div
                            class="flex items-center justify-center w-full h-full mx-auto btnNextPaginate hover:bg-slate-200">
                            @if ($mySkills->onFirstPage() || !$mySkills->onLastPage())
                                <a href="{{ $mySkills->nextPageUrl() }}">
                                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M9.71069 18.2929C10.1012 18.6834 10.7344 18.6834 11.1249 18.2929L16.0123 13.4006C16.7927 12.6195 16.7924 11.3537 16.0117 10.5729L11.1213 5.68254C10.7308 5.29202 10.0976 5.29202 9.70708 5.68254C9.31655 6.07307 9.31655 6.70623 9.70708 7.09676L13.8927 11.2824C14.2833 11.6729 14.2833 12.3061 13.8927 12.6966L9.71069 16.8787C9.32016 17.2692 9.32016 17.9023 9.71069 18.2929Z"
                                            fill="#0F0F0F" />
                                    </svg>
                                </a>
                            @endif
                        </div>
                    </div>

                </div>
            @endif
        </div>
    </div>
    @if ($addSkill)
        {{-- @dd($mySkills) --}}
        @livewire('add-skill')
    @endif
    @if ($editSkill)
        {{-- @dd($mySkills) --}}
        @livewire('edit-skill', ['idSkill' => $editSkillId])
    @endif
    <script>
        // $(document).ready(() => {
        //     const tableSkills = document.getElementById('tableSkills')
        //     let tableSkillsDataTable;
        //     tableSkillsDataTable = new DataTable(tableSkills, {
        //         paging: false
        //     })
        //     window.Livewire.on('filterUpdated', () => {
        //         console.log("filter updated");
        //         if ($.fn.dataTable.isDataTable(tableSkills)) {
        //             tableSkillsDataTable.destroy()
        //         }
        //         tableSkillsDataTable = new DataTable(tableSkills, {
        //             paging: false
        //         })
        //     })
        // })
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
