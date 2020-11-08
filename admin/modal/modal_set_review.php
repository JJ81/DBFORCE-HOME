<div class="modal fade" id="modalSetReview" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" v-if="mode === 'ADD'">후기 등록</h3>
                <h3 class="modal-title" v-else-if="mode === 'MOD'">후기 수정</h3>
                <h3 class="modal-title" v-else-if="mode === 'VIEW'">후기 보기</h3>
                <button type="button" class="close btn-modal-close" data-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <div class="modal-body">
                <table class="table">
                    <colgroup>
                        <col width="150">
                        <col width="*">
                    </colgroup>
                    <tr v-if="mode === 'MOD' || mode === 'VIEW'">
                        <td colspan="2">
                            <img :src="drawThumbnail()" :alt="title" width="100%" />
                        </td>
                    </tr>
                    <tr>
                        <th>제목</th>
                        <td>
                            <input type="text"
                                   v-model="title"
                                   class="form-control"
                                   placeholder="후기 구분을 위해서 제목 입력하세요." />
                        </td>
                    </tr>
                    <tr>
                        <th>위치</th>
                        <td>
                            <select v-model="position" class="form-control">
                                <option value="null">출력 위치를 선택하세요.</option>
                                <option value="S">종잣돈모으기</option>
                                <option value="T">투자훈련소</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>순서</th>
                        <td>
                            <input type="text"
                                   v-model="order"
                                   class="form-control"
                                   placeholder="순서값을 입력하세요."/>
                        </td>
                    </tr>
                    <tr v-if="mode !== 'VIEW'">
                        <th>이미지 선택</th>
                        <td>
                            <input type="file"
                                   v-model="thumbnail"
                                   id="upload-file-img"
                                   accept="image/gif,image/png,image/jpg,image/jpeg"
                                   class="form-control jp-ld-uploader" />
                        </td>
                    </tr>
                </table>
            </div>

            <div class="modal-footer clearfix">
                <a href="#" class="btn btn-success"
                   @click="addNewReview"
                   v-if="mode == 'ADD'">추가</a>
                <a href="#" class="btn btn-warning"
                   v-if="mode === 'MOD'"
                   @click="modifyReview"
                   v-if="mode=='MOD'">수정</a>
                <button type="button" class="btn btn-outline-primary" data-dismiss="modal">닫기</button>
            </div>
        </div>
    </div>
    <input type="hidden" value="<?php echo ROOT;?>assets/review/" class="img-path" />
    <input type="hidden" v-model="id" />
</div>