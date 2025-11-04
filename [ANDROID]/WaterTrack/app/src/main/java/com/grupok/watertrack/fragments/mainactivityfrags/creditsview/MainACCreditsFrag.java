package com.grupok.watertrack.fragments.mainactivityfrags.creditsview;

import android.os.Bundle;

import androidx.fragment.app.Fragment;
import androidx.recyclerview.widget.LinearLayoutManager;

import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;

import com.grupok.watertrack.R;
import com.grupok.watertrack.activitys.MainActivity;
import com.grupok.watertrack.databinding.FragmentMainACCreditsBinding;
import com.grupok.watertrack.databinding.FragmentMainACDetailsContadorBinding;
import com.grupok.watertrack.fragments.mainactivityfrags.detailscontadorview.RVAdapterFieldsDetailsContadores;

import java.util.ArrayList;
import java.util.List;


public class MainACCreditsFrag extends Fragment {


    private MainActivity parent;

    private FragmentMainACCreditsBinding binding;


    public MainACCreditsFrag() {
        // Required empty public constructor
    }

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);

    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        binding = FragmentMainACCreditsBinding.inflate(inflater);

        if(parent.currentUserInfo != null){
            init();
        }

        return binding.getRoot();


    }

    private void init(){
        List<String> credits = new ArrayList<>();
        credits.add("Desenvolvido por: Guilherme Silva");
        credits.add("Orientador: João Santos");
        credits.add("Curso: TeSP PSI");
        credits.add("Instituição: ESTG - IPLeiria");
        credits.add("Ano: 2025");

        CreditsAdapter adapter = new CreditsAdapter(credits);
        binding.rvCreditsMainAc.setLayoutManager(new LinearLayoutManager(getContext()));
        binding.rvCreditsMainAc.setAdapter(adapter);
    }
}