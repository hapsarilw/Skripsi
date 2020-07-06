<?php

	foreach ($requests as &$request) {
        if ($request->answer === NULL) {
            $request->status = 'MENUNGGU';
            $request->labelClass = 'warning';
        } else if ($request->answer === 'printed') {
            $request->status = 'TERCETAK';
            $request->labelClass = 'success';
        } else if ($request->answer === 'rejected') {
            $request->status = 'DITOLAK';
            $request->labelClass = 'danger';
        }
}
