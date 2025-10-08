package com.grupok.watertrack.database;

import androidx.room.TypeConverter;

import java.lang.reflect.Type;
import java.util.List;
import java.util.Locale;

public class Converters {

    @TypeConverter
    public static Locale fromLocaleString(String value) {
        String[] parts = value.split("_");
        if (parts.length == 1) {
            return new Locale(parts[0]);
        } else if (parts.length == 2) {
            return new Locale(parts[0], parts[1]);
        } else if (parts.length == 3) {
            return new Locale(parts[0], parts[1], parts[2]);
        } else {
            throw new IllegalArgumentException("Invalid locale string: " + value);
        }
    }

    @TypeConverter
    public static String toLocaleString(Locale locale) {
        return locale.toString();
    }
}