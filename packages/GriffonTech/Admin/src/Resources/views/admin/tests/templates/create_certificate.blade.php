<div>
    <label>Generate Certificate </label>
    <div>
        <label for="generate_certificate" style="font-weight: 500;">
            <input id="generate_certificate" type="checkbox"> No/Yes
        </label>
        <p>Click on "yes" for selecting certificate template. </p>
        <hr>
        <div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="certificate_title">Certificate title</label>
                        <input id="certificate_title" type="text" name="certificate_title" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="certificate_heading">Certificate Heading</label>
                        <input id="certificate_heading" type="text" name="certificate_heading" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="certificate_description">Certificate Description</label>
                        <textarea name="certificate_description" class="form-control" id="certificate_description" cols="30" rows="7"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="certificate_heading">Issuer Name</label>
                        <input id="certificate_heading" type="text" name="certificate_heading" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="certificate_heading">Issuer Position</label>
                        <input id="certificate_heading" type="text" name="certificate_heading" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="certificate_heading">Issuer Signature</label>
                        <input type="file" class="form-control" name="issuer_signature">
                    </div>

                    <div class="form-group">
                        <label for="show_date">
                            <input type="checkbox" id="show_date" name="show_date"> Display Date
                        </label>
                    </div>
                </div>
                <div class="col-sm-8"></div>
            </div>
            <div class="form-group float-right">
                <button class="btn btn-primary"> Save </button>
            </div>
        </div>
    </div>
</div>
