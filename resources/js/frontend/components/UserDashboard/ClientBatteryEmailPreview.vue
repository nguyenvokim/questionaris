<template>
    <div class="card">
        <div class="modal-header">
            Email Preview
        </div>
        <div class="card-body">
            <div><strong>{{headline}}</strong></div>
            <div style="white-space: pre-line">
                {{bodyText}}
            </div>
            <div class="text-center mt-4 mb-2">
                <a href="javascript:void(0)" class="btn btn-dark">Link to Questionnaire(s)</a>
            </div>
            <div style="white-space: pre-line">
                {{footerText}}
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        headline: {
            type: String
        },
        bodyText: {
            type: String
        },
        footerText: {
            type: String
        }
    }
}
</script>
