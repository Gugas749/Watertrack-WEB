package com.grupok.watertrack.fragments.mainactivityfrags.addcontadorview;

import android.os.Bundle;

import androidx.fragment.app.Fragment;

import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;

import com.grupok.watertrack.R;
import com.grupok.watertrack.activitys.MainActivity;
import com.grupok.watertrack.databinding.FragmentMainAcAddContadorBinding;

public class MainAcAddContadorFrag extends Fragment {

    private FragmentMainAcAddContadorBinding binding;
    private MainActivity parent;

    public MainAcAddContadorFrag() {
        // Required empty public constructor
    }
    public MainAcAddContadorFrag(MainActivity parent) {
        this.parent = parent;
    }


    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);

    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        binding = FragmentMainAcAddContadorBinding.inflate(inflater);



        return binding.getRoot();
    }
}