<?php

	foreach ($requests as &$request) {
        if ($request->answer === NULL) {
            $request->status = 'TUNGGU';
            $request->labelClass = 'secondary';
        } else if ($request->answer === 'confirmed') {
            $request->status = 'TERKONFIRMASI';
            $request->labelClass = 'success';
        } else if ($request->answer === 'rejected') {
            $request->status = 'DITOLAK';
            $request->labelClass = 'danger';
        }
}
