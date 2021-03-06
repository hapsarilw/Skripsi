<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!doctype html>
<html class="no-js" lang="en">
    <?php $this->load->view('templates/head_loggedin'); ?>
    <body>
        <?php $this->load->view('templates/topbar_loggedin'); ?>
        <?php $this->load->view('templates/flashmessage'); ?>
        <br>
        <div class="container">
            <div class="row ">
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            Permohonan Baru
                        </div>
                        <div class="card-body">

                            <?php if (is_array($forbiddenTypes)): ?>
                                <form method="POST" action="/TranskripRequest/add">
                                    <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>" />
                                    <div class="row">
                                        <div class="col-lg-4 form-group">
                                            <label class="col-form-label">Yang memohon:</label>
                                            <input class="form-control" type="email" name="requestByEmail" value="<?= $requestByEmail ?>" readonly/>
                                        </div>
                                        <div class="col-lg-4 form-group">
                                            <label class="col-form-label">NPM:</label>
                                            <input class="form-control" type="text" value="<?= $requestByNPM ?>" readonly/>
                                        </div>
                                        <div class="col-lg-4 form-group">
                                            <label class="col-form-label">Nama:</label>
                                            <input class="form-control" type="text" name="requestByName" value="<?= $requestByName ?>" readonly/>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4 form-group">
                                            <label class="col-form-label">Tipe Transkrip:</label>
                                            <select class="form-control" name="requestType">
                                                <?php foreach (Transkrip_model::REQUEST_TYPES as $type => $name): ?>
                                                    <?php if (!in_array($type, $forbiddenTypes)): ?>
                                                        <option value="<?= $type ?>"><?= $name ?></option>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="col-lg-8 form-group">
                                            <label class="col-form-label">Keperluan:</label>
                                            <input class="form-control" type="text" name="requestUsage" required/>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-lg-12 form-group">
                                            <input class="btn btn-primary" type="submit" class="button" value="Kirim Permohonan">
                                        </div>
                                    </div>
                                </form>
                            <?php else: ?>
                                <p>&nbsp;</p>
                                <?= $forbiddenTypes ?>
                            <?php endif ?>
                        </div>

                    </div>
                    <br>
                    <div class="card">
                        <div class="card-header">
                            Histori Permohonan
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Tanggal Permohonan</th>
                                    <th scope="col">Tipe Transkrip</th>
                                    <th scope="col">Tanggal Jawab/Cetak</th>
                                    <th scope="col">Keterangan</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($requests as $request): ?>
                                    <tr>
                                        <th>#<?= $request->id ?></th>
                                        <td><span class="badge badge-<?= $request->labelClass ?>"><?= $request->status ?></span></td>
                                        <td><time datetime="<?= $request->requestDateTime ?>"><?= $request->requestDateString ?></time></td>
                                        <td><?= $request->requestType ?></td>
                                        <td><time datetime="<?= $request->answeredDateTime ?>"><?= $request->answeredDateString ?></td>
                                        <td><?= $request->answeredMessage ?></td>
                                        <td>
                                            <!-- Button trigger modal -->
                                            <a data-toggle="modal" data-target="#lihatModal<?= $request->id ?>" id="detail<?= $request->id ?>">
                                                <i class="fas fa-eye"></i>
                                            </a>

                                            <!-- Modal -->
                                            <div class="modal fade" id="lihatModal<?= $request->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLongTitle">Detail Permohonan #<?= $request->id ?></h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <table class="table ">
                                                                <tbody>
                                                                <tr>
                                                                    <th>E-mail Pemohon</th>
                                                                    <td><?= $request->requestByEmail ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Nama Pemohon</th>
                                                                    <td><?= $request->requestByName ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Tanggal Permohonan</th>
                                                                    <td><?= $request->requestDateTime ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Tipe Transkrip</th>
                                                                    <td><?= $request->requestType ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Keperluan</th>
                                                                    <td><?= $request->requestUsage ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="col">Jawaban</th>
                                                                    <td><?= $request->answer ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <th>E-mail Penjawab</th>
                                                                    <td><?= $request->answeredByEmail ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Tanggal Dijawab</th>
                                                                    <td><?= $request->answeredDateTime ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Keterangan Penjawab</th>
                                                                    <td><?= $request->answeredMessage ?></td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php $this->load->view('templates/script_foundation'); ?>
    </body>
</html>