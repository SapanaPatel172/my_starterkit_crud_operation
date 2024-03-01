<x-default-layout>

    @section('title')
    Email Templates
    @endsection

    <div class="text-end pt-15">
        <button type="button" class="btn btn-primary" onclick="goBack()">Back</button>
    </div>

    <div class="card">
        <!--begin::Card header-->
        <div class="card-header border-0 pt-6">
            <!--begin::Card body-->
            <div class="card-body py-4">
                <!--begin::Form-->
                <form class="form">
                    <div class="d-flex">
                        <div class="col-6">
                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="required fw-semibold fs-6 mb-2">Title</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text" name="title" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Title" value="{{$emailTemplates->title}}" />
                                <!--end::Input-->
                                @error('title')
                                <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="required fw-semibold fs-6 mb-2">Tags</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text" name="tags" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="tags" value="{{$emailTemplates->tags}}" />
                                <!--end::Input-->
                                @error('tags')
                                <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="required fw-semibold fs-6 mb-2">Template</label>
                                <!--end::Label-->
                                <!--begin::Input-->

                                <textarea class="form-control" name="template" id="summernote">{{$emailTemplates->template}}</textarea>

                                <!--end::Input-->
                                @error('template')
                                <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <!--end::Input group-->
                        </div>
                        <div class="col-6 ms-2">
                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="required fw-semibold fs-6 mb-2">Slug</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text" name="slug" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="slug" value="{{$emailTemplates->slug}}" />
                                <!--end::Input-->
                                @error('slug')
                                <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="required fw-semibold fs-6 mb-2">description</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text" name="description" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="description" value="{{$emailTemplates->description}}" />
                                <!--end::Input-->
                                @error('description')
                                <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="required fw-semibold fs-6 mb-2">Status</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <select name="status" class="form-select form-select-solid mb-3 mb-lg-0">
                                    <option value="" disabled>Select Status</option>
                                    @foreach($statuses as $status)
                                    <option value="{{$status}}" @if($status[0] == $emailTemplates->status) selected @endif>{{$emailTemplates->status }}</option>
                                    @endforeach
                                </select>
                                <!--end::Input-->
                                @error('status')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <!--end::Input group-->


                        </div>
                    </div>
                </form>
                <!--end::Form-->
            </div>
            <!--end::Card body-->

        </div>

        <script type="text/javascript">
            // Function to go back using the browser's history
            function goBack() {
                window.history.back();
            }

            // Initialize Summernote when the document is ready
          
                var summernoteInstance = $('#summernote');

                summernoteInstance.summernote({
                    height: 400
                });

                // Disable Summernote editor
                summernoteInstance.summernote('disable');

                // Disable input fields
                $('input, select, textarea').prop('disabled', true);
           
        </script>
</x-default-layout>