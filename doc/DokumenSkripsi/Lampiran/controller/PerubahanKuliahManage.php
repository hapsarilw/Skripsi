<?php

    foreach ($requests as &$request) {
        if ($request->answer === NULL) {
            $request->status = 'MENUNGGU';
            $request->labelClass = 'warning';
        } else if ($request->answer === 'confirmed') {
            $request->status = 'TERKONFIRMASI';
            $request->labelClass = 'success';
        } else if ($request->answer === 'rejected') {
            $request->status = 'DITOLAK';
            $request->labelClass = 'danger';
		}
}
