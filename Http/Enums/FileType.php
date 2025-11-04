<?php

namespace Http\Enums;

class FileType extends Enums
{
    const PDF = "application/pdf";
    const DOC = "application/msword";
    const DOCX = "application/vnd.openxmlformats-officedocument.wordprocessingml.document";
    const XLS = "application/vnd.ms-excel";
    const XLSX = "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet";
    const PPT = "application/vnd.ms-powerpoint";
    const PPTX = "application/vnd.openxmlformats-officedocument.presentationml.presentation";
    const TXT = "text/plain";
    const CSV = "text/csv";
    const JPG = "image/jpeg";
    const PNG = "image/png";
    const GIF = "image/gif";
}
